<x-form :action="route('share.store', [tenant('tenant_id'), 'batch'])">
    <input type="hidden" name="work_item" value="{{ $argOne }}">
    <input type="hidden" name="batch_id" value="{{ $argTwo }}">

    <div class="row">
        <div class="col-12 form-group">
            <div class="row justify-content-between">
                <div class="col-4">
                    <x-input.label for="usrlist">{{ __('Search For Users') }}</x-input.label>
                </div>
                <div class="col-4">
                    @if(user()->account_type == 1 && tenant('tenant_id') == 'host')
                        <x-input.checkbox id="all_users" name="all_users" label="All users" value="1" checked="true"/>
                    @endif
                </div>
            </div>

            <x-input.text id="search_user" name="search_user" labeless :wrap="false"/>
            <br/>
            <x-select class="select-user" name="Select Users" id="usrlist" multiple>
            </x-select>
        </div>
        <x-select class="chosen-users" name="users[]" label="Selected Users" id="usrlist1" multiple required/>
        <x-input.text required name="message" :placeholder="__('Enter a message to the recipients')"/>
    </div>

    <div class="text-right pt-3">
        <x-button sm pill>{{ __('Send') }}</x-button>
        <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>
</x-form>

<script>
    $(async () => {
        const users = await this.fetchUsers()

        this.setSelectOptions(users, '#usrlist')

        let opts = $('#usrlist option').map(function () {
            return [
                [this.value, $(this).text()]
            ];
        });

        $('#search_user').keyup(function () {
            let rxp = new RegExp($('#search_user').val(), 'i');
            let usrlist = $('#usrlist').empty();
            opts.each(function () {
                if (rxp.test(this[1])) {
                    usrlist.append($('<option/>').attr('value', this[0]).text(this[1]));
                } else {
                    usrlist.append($('<option/>').attr('value', this[0]).text(this[1]).addClass(
                        "hidden"));
                }
            });
            $(".hidden").toggleOption(false);
        });
        $('.select-user').click(function () {
            $('.select-user option:selected').remove().appendTo('.chosen-users');
            opts = $('#usrlist option').map(function () {
                return [
                    [this.value, $(this).text()]
                ];
            });
        });

        $('.chosen-users').click(function () {
            $('.chosen-users option:selected').remove().appendTo('.select-user');
            opts = $('#usrlist option').map(function () {
                return [
                    [this.value, $(this).text()]
                ];
            });
        });
    });

    jQuery.fn.toggleOption = function (show) {
        jQuery(this).toggle(show);
        if (show) {
            if (jQuery(this).parent('span.toggleOption').length)
                jQuery(this).unwrap();
        } else {
            if (jQuery(this).parent('span.toggleOption').length == 0)
                jQuery(this).wrap('<span class="toggleOption" style="display: none;" />');
        }
    };

    $("#all_users").change(async (event) => {
        const selectId = '#usrlist'
        const checkBoxValue = event.target.checked
        $(selectId).empty()
        $("#usrlist1").empty()

        const users = await this.fetchUsers(checkBoxValue)
        this.setSelectOptions(users, selectId)
    });

    function setSelectOptions(options, selectId){
        const data = Object.entries(options).map(([key, value]) => ({key,value}));

        data.forEach((value) => {
            $(selectId).append($('<option>', {
                value: value.key,
                text : value.value
            }));
        })
    }

    async function fetchUsers(checkBoxValue = true){
        const routeUrl = "{{ route('share.users.list', tenant('tenant_id')) }}"
        return $.ajax({
            url: routeUrl,
            method: "POST",
            data: {
                show_all_users: checkBoxValue
            },
            success: function(data, status, xhr) {
                if (!xhr.responseJSON) {
                    location.reload();
                    return false;
                }
                return data
            },
            error: () => {
                console.error("Server error, check your response");
            },
        });
    }
</script>
