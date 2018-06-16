<?php use Core\Session;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>


include 'header.php' ?>
<div id="app">
    <div id="application-wrapper">


        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Home</a>
        </nav>

        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3">Hello, world!</h1>
                    <p>This is a template for a simple marketing or informational website. It includes a large callout
                        called a
                        jumbotron and three supporting pieces of content. Use it as a starting point to create something
                        more
                        unique.</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <products-form inline-template>
                        <div class="mb-5">
                            <button class="btn btn-info" @click="visible = !visible">Create Product</button>
                            <form class="w-100" v-if="visible" method="post" action="/resource">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" name="category" class="form-control" id="category">
                                </div>
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name">
                                </div>
                                <div class="form-group">
                                    <label for="brand_name">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name">
                                </div>

                                <div class="form-group">
                                    <label for="brand_name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>

                                <div class="form-group">
                                    <label for="brand_name">Description</label>
                                    <input type="text" name="description" class="form-control" id="description">
                                </div>

                                <div class="form-group">
                                    <label for="brand_name">Price</label>
                                    <input type="text" name="price" class="form-control" id="price">
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </products-form>
                </div>
            </div>

            <products inline-template>
                <div class="container">
                    <button class="btn btn-info" @click="shuffle">Shuffle</button>
                    <!-- Example row of columns -->
                    <div id="items-wrapper" class="row">
                        <transition-group name="product" tag="div" class="row">
                            <div class="col-md-4" v-for="(product, index) in products" :key="product.id"
                                 class="product">
                                <h2>{{product.brand_name}} </h2>
                                <p> {{product.description}} </p>
                                <p>
                                    <img :src="product.image" alt="" class="w-100">
                                    <a class="btn btn-secondary" href="#" role="button">View details</a>
                                    <button class="btn btn-danger" href="#" @click="remove(index,product.id)"
                                            role="button">
                                        Delete
                                    </button>
                                </p>
                            </div>
                        </transition-group>
                    </div> <!-- /container -->
                </div>
            </products>

        </main>
    </div>

</div>

<?php include 'footer.php' ?>
</body>
</html>