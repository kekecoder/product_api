# Api With Using PHP and MySQL

This is my first API written in PHP/MySQL to create product

## Here is the list of endpoint

1. To get the list of products in the database
   `GET http://127.0.0.1:8000 HTTP/1.1`

2. To create a new product
   `POST http://127.0.0.1:8000/api-create.php HTTP/1.1`

`{
    "name" : "Pen",
    "price" : 25
}`

3. To edit a product
   `PUT http://127.0.0.1:8000/api-update.php HTTP/1.1`

`{
   "product_id" : 3,
   "product_name" : "Checks shirt",
   "product_price" : 2000
 }`

4. To delete a product
   `DELETE http://127.0.0.1:8000/api-delete.php HTTP/1.1`

`{
     "product_id" : 5
 }
`

### if the product id does not exist, it will throw a 404 error response code

5. To view a single product
   `GET http://127.0.0.1:8000/single-product.php HTTP/1.1`

   `{
    "product_id" : 5
}
`

   ### if the product id does not exist, it will throw a 404 error response code

6. To perform a search operation using either string or integer
   `GET http://127.0.0.1:8000/api-search.php`

`{
"search" : "1"
}
`
or
`{
"search" : "shirts"
}
`

In addition, i also perform some basic authentication.
