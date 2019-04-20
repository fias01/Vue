new Vue({
    el   : "#app",
    data : {
        judul : 'Latihan',
        isi   : 'Praktek Vue',
        titles: [
          'Prabowo Menang',
          'Fias Menikah',
          '#02 Menang Pemilu'
        ]
    },

    methods : {
        ubahJudul(value){
            this.judul = value;
        },

        ubahIsi(){
            this.isi   = "Ini belajar button Mengubah dengan function";
        }
    }
});
