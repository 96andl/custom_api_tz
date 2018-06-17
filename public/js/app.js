const EventBus = new Vue();


Vue.component('modal', {
    data: function () {
        return {
            showModal: false
        }
    },

    created: function () {
        var context = this;
        EventBus.$on('showEditProductModal', function () {
            context.showModal = !context.showModal
        });
    },
});


Vue.component('products-form', {
    data: function () {
        return {
            visible: false,
            products: null,
            product_id: null,
            category: null,
            brand_name: null,
            product_name: null,
            name: null,
            description: null,
            price: null
        }
    },

    created: function () {
        var context = this;
        EventBus.$on('showEditProductModal', function (index) {
            context.initializeInputs(index);
        });

        EventBus.$on('productsFetched', function (products) {
            context.products = products;
        });
    },
    methods: {
        initializeInputs: function (index) {
            this.product_id = this.products[index].id;
            this.category = this.products[index].category;
            this.brand_name = this.products[index].brand_name;
            this.product_name = this.products[index].product_name;
            this.name = this.products[index].name;
            this.description = this.products[index].description;
            this.price = this.products[index].price;
        },

        update: function () {

            var data = {};
            var context = this;
            $.each($('#edit-product-form').serializeArray(), function () {
                data[this.name] = this.value;
            });

            axios.put('resource', data)
                .then(function (response) {
                    EventBus.$emit('productUpdated', response.data);
                    context.$emit('updated');
                })
                .catch(function (error) {
                    console.error(error);
                });
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
                EventBus.$emit('productsFetched', context.products);
            }
        });


        EventBus.$on('productUpdated', function (updatedProduct) {
            context.products.forEach(function (product, index) {
                if (Number(product.id) === Number(updatedProduct.id)) {
                    context.products.splice(index, 1, updatedProduct);
                }
            });
        });
    },

    methods: {
        randomArray: function (a, b) {
            return Math.random() - 0.5;
        },

        shuffle: function () {
            this.products.sort(this.randomArray);
        },
        showEditProductModal: function (index) {
            EventBus.$emit('showEditProductModal', index);
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
        },
    }
})
;

var app = new Vue({
    el: '#app'
});
