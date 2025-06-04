import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import { createApp } from 'vue';
import IngredientLike from './components/IngredientLike.vue';
import FavoriteIngredientList from './components/FavoriteIngredientList.vue';
 
const app = createApp({});
app.component('ingredient-like', IngredientLike);
app.component('favorite-ingredient-list', FavoriteIngredientList);
app.mount('#app');
