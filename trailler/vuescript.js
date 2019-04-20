var MyInput = {
  template: `
    <div class="kotak" style="border: 2px solid; width: 150" >
      <img :src="img" width="150">
      <h1>{{ judul }}</h1>
    </div>
  `,
  props: ['judul', 'img']
};

Vue.component('produk', MyInput);

new Vue({
  el: '#app'
});
