Vue.component('products-form', {
    data: function () {
        return {
            visible: false
        }
    },
});

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
        randomArray: function (a, b) {
            return Math.random() - 0.5;
        },

        shuffle: function () {
            this.products.sort(this.randomArray);
        },
        remove: function (index, id) {
            var context = this;
            axios.delete('resource', {
                data:
                    {id: id}
            })
                .then(function () {
                    context.products.splice(index, 1);
                })
                .catch(function (error) {
                    console.log(error);
                })
        }

    }
})
;

var app = new Vue({
    el: '#app'
});
