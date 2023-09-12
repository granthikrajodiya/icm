<div id="color-select-content">

    <div class="row">
        <div class="form-group col-12">
            <label for="data_value" class="form-control-label">
                Data Value
            </label>
            <input type="text" name="data_value" id="data_value" value="" class="form-control" required="required">
        </div>


        <div class="form-group col-12">
            <label class="form-control-label">
                Color
            </label>
            <div  class="color-selector">
                <div class="color-select">
                    <input class="float-left color-input" type="color" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="" required>
                </div>

                <input class="form-control col-10 " type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="" id="hexcolor"  required>
            </div>
            <input type="hidden" name="color_id" id="color_id" value="">
        </div>
    </div>
    <div class="pt-5">
        <div class="float-right ">
            <x-button type="button" sm pill id="submit_color_select">{{ __('OK') }}</x-button>
            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>

