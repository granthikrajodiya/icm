import Alpine from 'alpinejs'
import contentTypeSelect from './content-type-select'

window.Alpine = Alpine
window.Alpine.start()

Alpine.data('contentTypeSelect', contentTypeSelect)
