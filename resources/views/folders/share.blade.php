<x-form :action="route('share.store', [tenant('tenant_id'), 'document'])">
    <input type="hidden" name="app" value="{{ $argOne }}">
    <input type="hidden" name="docId" value="{{ $argTwo }}">

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

        setSelectOptions(users, '#usrlist')

        let opts = getSelectOptions()

        $('#search_user').keyup(function () {
            searchUser()
        });
        $('.select-user').click(function () {
            $('.select-user option:selected').remove().appendTo('.chosen-users');
            opts = getSelectOptions()
        });

        $('.chosen-users').click(function () {
            $('.chosen-users option:selected').remove().appendTo('.select-user');
            opts = getSelectOptions()
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
        document.getElementById("all_users").disabled = true;

        setTimeout(async () => {
            const selectId = '#usrlist'
            const checkBoxValue = event.target.checked
            $(selectId).empty()
            $("#usrlist1").empty()
            const users = await fetchUsers(checkBoxValue)
            setSelectOptions(users, selectId)
            document.getElementById("all_users").disabled = false;

            // after toggle all_user , do search since user can find first before toggling
            searchUser()
        }, "1000")

    });

    function searchUser(){
        let rxp = new RegExp($('#search_user').val(), 'i');
        let options = getSelectOptions()
        let usrlist = $('#usrlist').empty();
        options.each(function () {
            let nameNoTenantID = this[1].substr(0, this[1].indexOf('('));
            if (rxp.test(nameNoTenantID)) {
                usrlist.append($('<option/>').attr('value', this[0]).text(this[1]));
            } else {
                usrlist.append($('<option/>').attr('value', this[0]).text(this[1]).addClass(
                    "hidden"));
            }
        });
        $(".hidden").toggleOption(false);
    }

    function setSelectOptions(options, selectId){
        const data = Object.entries(options).map(([key, value]) => ({key,value}));
        $(selectId).empty()
        data.forEach((value) => {
            $(selectId).append($('<option>', {
                value: value.key,
                text : value.value
            }));
        })
    }

    function getSelectOptions(){
        return $('#usrlist option').map(function () {
            return [
                [this.value, $(this).text()]
            ];
        });
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
