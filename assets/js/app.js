import 'bootstrap';
import 'jquery';
import WOW from 'wow.js';
import '../css/global.scss';
// import React from 'react';
// import ReactDOM from 'react-dom';
// import ymaps from 'ymaps';

import $ from 'jquery';
// require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    // document.location.href='#';

});

new WOW().init();

// import './filtr'
import './internalText'
import './dropMenu'
import './scriptCadEffect.js'
// import './modalForAdmin'
// import './viewAll'

// $(window).on('beforeunload', function () {
//     window.scrollTo(0, 0);
// });

// class App extends React.Component {
//     render() {
//         // ymaps.load()
//         //     .then(maps => {
//         //         const map = new maps.Map('your-map-container', {
//         //             center: [-8.369326, 115.166023],
//         //             zoom: 7
//         //         });
//         //         console.dir(111, map)
//         //     })
//         //     .catch(error => console.log('Failed to load Yandex Maps', error));
//         // ymaps.load().then(ymaps => console.log(ymaps))
//         // console.log(333,  ymaps)
//         // console.log(222, ymaps.load('//api-maps.yandex.ru/2.1/?lang=en_US&load=Map'))
//         return (
//             <div>
//                 <p>Hello</p>
//
//             </div>
//         )
//     }
// }
// ReactDOM.render(<App/>, document.getElementById('root'));

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.


// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


