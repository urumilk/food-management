import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import { createApp } from 'vue';
import IngredientLike from './components/IngredientLike.vue';
 
const app = createApp({});
app.component('ingredient-like', IngredientLike);
app.mount('#app');
