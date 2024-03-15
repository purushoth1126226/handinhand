Vue.use(Dropdown);

var app = new Vue({
    el: '#app',
    data: {
        isProcessing: false,
        druglist: [],
        form: {},
        errors: {},
    },
    created: function () {
        Vue.set(this.$data, 'form', _form);
        this.$http.post('searchdruglist').then(function (response) {
            this.druglist = response.data.druglist;
            console.log(response.data);
        }).catch(function (response) {
            console.log(response);
            console.log('fail');
        }.bind(this));
    },
    // mounted() {
    //     this.druglist = [
    //         { key: 1, value: 'A' },
    //         { key: 2, value: 'B' },
    //         { key: 3, value: 'C' }
    //     ];
    // },
    methods: {
        addLine: function () {
            this.form.drug.push({
                drug: 1,
                morning: false,
                afternoon: false,
                evening: false,
                night: false,
                bf: false,
                af: false,
                count: 0,
                pharmacycount: 0,
            });
        },
        remove: function (product) {
            let index = this.form.drug.indexOf(product)
            this.form.drug.splice(index, 1);
        },
    },
    computed: {

    }
})