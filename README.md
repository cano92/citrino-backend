
## Citrino

ABM de Articulos (Product) donde el usuario Administra el stock de productos atravez de funciones(transacciones) realizando

***comprar( buy )***    y/o   ***vender( sale )***

ademas de las funciones de reportes y paginacion 

#### UML

![uml](uml/citrino.png)


##### compra ( buy )
registra una compra con una lista de productos (categoria, genero, temporada), y un medio de pago (efectivo o debito)
##### venta ( sale )
registra una venta con una lista de **items** (product, cantidad, subtotal), un medio de pago (efectivo o debito) y actualiza  el **Stock** de cada producto 


##### reportes --varios
> * productos en stock
> * productos por categoria
> * productos por genero
> * ventas
> * ventas efectivo
> * ventas debito
> * \...


plataforma BackEnd API REST de compra, venta y administracion de stock con **symfony 4**, fosrestbundle ,doctrine ORM 
