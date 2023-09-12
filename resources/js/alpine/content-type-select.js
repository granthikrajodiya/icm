export default () => ({
    hidePartialValues:[
        'Horizontal bar Chart',
        'Vertical bar Chart',
        'Line Chart',
        'Pie Chart',
        'KPI Card',
        'Calendar',
        'Notifications',
        'Custom HTML',
        'Custom Page'
    ],
    hideMaxItemsValues: [
        'KPI Card',
        'Calendar',
        'Custom HTML'
    ],
    hidePartialInputs: false,
    hideMaxItems: false,
    onChangeSelect(selectedValue){
        this.hidePartialInputs = this.hidePartialValues.some((element) => {
            return element == selectedValue
        })
        this.hideMaxItems = this.hideMaxItemsValues.some((element) => {
            return element == selectedValue
        })
    },
    init() {
        let selectedContentType = document.getElementsByName("content_type");
        this.onChangeSelect(selectedContentType[0].value)
    }
})
