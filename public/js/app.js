Vue.component('products', {
    data: function () {
        return {
            products: []
        }
    },
    created: function () {
        var context = this;
        $.ajax({
            url: "resource",
            method: "GET",
            success: function (response) {
                context.products = response;
            }
        });
    },

    methods: {
        randomArray: function(a, b) {
            return Math.random() - 0.5;
        },

        shuffle: function () {
            this.products.sort(this.randomArray);
        },
        remove: function (id) {
            axios.delete('resource')
                .then(function () {
                    alert("OK");
                })
                .catch(function ()
                {
                    alert("ERROR");
                })
        }

    }
})
;

var app = new Vue({
    el: '#app'
});
