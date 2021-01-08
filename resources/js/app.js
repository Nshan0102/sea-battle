/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');

window.Vue = require('vue');*/

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/*const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/
import { EmojiButton } from '@joeattardi/emoji-button';
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});
window.picker = new EmojiButton({
    autoHide: false,
});
/*window.picker = new EmojiButton({

    // position of the emoji picker. Available positions:
    // auto-start, auto-end, top, top-start, top-end, right, right-start, right-end, bottom, bottom-start, bottom-end, left, left-start, left-end
    position: 'auto',

    // 1.0, 2.0, 3,0, 4.0, 5.0, 11.0, 12.0, 12.1
    emojiVersion: '12.1',

    // root element
    rootElement: document.body,

    // enable animation
    showAnimation: true,

    // auto close the emoji picker after selection
    autoHide: true,

    // auto move focus to search field or not
    autoFocusSearch: true,

    // show the emoji preview
    showPreview: true,

    // show the emoji search input
    showSearch: true,

    // show recent emoji
    showRecents: true,

    // show skin tone variants
    showVariants: true,

    // show category buttons
    showCategoryButtons: true,

    // or 'twemoji'
    style: 'native',

    twemojiOptions: {
        ext: '.svg',
        folder: 'svg'
    },

    // 'light', 'drak', or 'auto'
    theme: 'light',

    // number of emojis per row
    emojisPerRow: 5,

    // number of rows
    rows: 5,

    // emoji size
    emojiSize: '64px',

    // maximum number of recent emojis to save
    recentsCount: 50,

    // initial category
    initialCategory: 'recents',

    // z-index property
    zIndex: 999,

    // an array of the categories to show
    categories: [
        'smileys',
        'people',
        'animals',
        'food',
        'activities',
        'travel',
        'objects',
        'symbols',
        'flags'
    ],

    // custom emoji
    custom: [],

    // custom icons
    icons: {},

    // i18n
    i18n: {
        search: 'Search',
        categories: {
            recents: 'Recently Used',
            smileys: 'Smileys & People',
            animals: 'Animals & Nature',
            food: 'Food & Drink',
            activities: 'Activities',
            travel: 'Travel & Places',
            objects: 'Objects',
            symbols: 'Symbols',
            flags: 'Flags'
        },
        notFound: 'No emojis found'
    }

});*/
