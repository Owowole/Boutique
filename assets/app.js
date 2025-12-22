import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import { ClassicEditor } from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ckeditor').forEach((textarea) => {
        ClassicEditor
            .create(textarea, {
                language: 'fr'
            })
            .catch(error => {
                console.error(error);
            });
    });
});


console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
