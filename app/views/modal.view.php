<?php

use Core\Session;

?>
<modal inline-template>
    <transition name="modal">
        <div class="modal-mask" v-show="showModal">
            <div class="modal-wrapper">
                <div class="modal-container" style="width: 70%">

                    <div class="modal-header">
                        <slot name="header">
                            Edit Product
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <products-form inline-template @close="showModal = false" @updated="showModal = false">
                                <div class="mb-5 w-100">
                                    <form class="w-100" method="post" action="/product/update" id="edit-product-form">
                                        <input type="hidden" name="product_id" :value="product_id">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <input type="text" name="category" v-model="category" class="form-control"
                                                   id="category">
                                        </div>
                                        <div class="form-group">
                                            <label for="brand_name">Brand Name</label>
                                            <input type="text" name="brand_name" v-model="brand_name"
                                                   class="form-control" id="brand_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="product_name" v-model="product_name"
                                                   class="form-control" id="product_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" v-model="name" class="form-control"
                                                   id="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" v-model="description"
                                                   class="form-control" id="description">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" v-model="price" class="form-control"
                                                   id="price">
                                        </div>
                                        <div class="form-group">
                                            <label for="editable_image">Price</label>
                                            <input type="file" name="image" class="form-control" id="editable_image" onchange="readURL(this, '#image-preview')">
                                            <img :src="'/storage'+image" alt="" id="image-preview">
                                        </div>
                                        <?php if (!is_null($errors = Session::getFlash('errors'))): ?>
                                            <div class="alert alert-danger">
                                                <ul>
                                                    <?php foreach ($errors['errors'] as $error): ?>
                                                        <li><?= $error ?></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        <?php endif ?>
                                        <button type="submit" class="btn btn-primary" @click.prevent="update">Edit
                                        </button>
                                    </form>
                                    <div class="alert alert-danger" v-if="errors.length > 0">
                                        <ul>
                                            <li v-for="(error, index) in errors" :key="index">{{error}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </products-form>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="btn btn-success" @click="showModal = false">
                                OK
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</modal>