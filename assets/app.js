import "./tailwind.css";
import 'flowbite';


import.meta.glob([
    './images/**'
]);

// Import AlpineJS
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()