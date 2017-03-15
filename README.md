# ITI_PHP_Zend

@mZone

Abstract Description

@mZone ​ ​
is an e-commerce web application Zend based with 2 types of desired users

customer user and shope user beside the application admin user.
Features


1- Home Page

A) Contains a slider shows the popular products, new products, new offers whatever your
handling. (Refer to Amazon Home Page)

B) Contains a Category(Departments). These categories are maintained by the Admin.

(refer to Amazon Departments menu)

C) A search bar , when the user type a word then hit enter , it will get him the any matching
results of products .


2- Users

There would be ​ 3 kind of users ​ in the system:

A) Customer User ​: 

can navigate categories and products, and either add them to his
shopping card So that each item added to the shopping card the total price should be
calculated.

Or he can add the item to his wish list and here no price calculation needed ​.
He can also put a rate on product, share his experience (put a comment).

B) Shop user ​: can add items (products) and specify to which category his item is.
He can also add offer on his product with start and end date

This offer is a discount a number % that if a customer user added this item during the
start date and end date of the offer the price of the item become the price after discount
WITHOUT updating the item price in the database.but mention in the shopping item list
price the original price and the discount amount the final total price in detailed bill
display.

C) Admin user ​: can block users so they can’t login to the system, crud on the categories.

admin can send sale coupons to users (a random string will be generated with a
discount amount and an email should be sent to a specific user to user.

an example email:

Hello Mr Ahmed

We have made a discount for you with amount of 30 % for the upcoming purchase
Order.

write this in discount field when purchasing next time :-

e2dc6c48c56de466f6d13781796abf3d

So the sequence is like that:

- The admin create discount, this should produce a specific string indicate to a specific

discount amount.

- The admin can list all users with action block and send discount coupon action that

should be a selection from the pre-created coupons and send it to user’s email.
The customer user uses this coupon string is his shoping card if he put this string he got
the amount of discount on his total purchases.

3- Authentication

A) An un logged in user can only navigate the categories and products, can’t add to shop
card or wish list or crud on product if he is a shop customer.

B) User can signup using system registration form.

C) User can login the system using system login form, facebook and google+


4- Product

A) Product displayed (name, description, photo, rate price, SALE(offer, discount))
Refer to amazon product display. , products are translatable in english and in arabic ,
We need a two drop down lists with (en,ar) when the user choose (ar) the products will
Be translated into arabic , if he choose (en) the products will be translated into english,
That’s mean products must be filled both in arabic and in english when creating

B) And again the product creator only, at any time when enter his product page he can
enter 3 information to set a SALE of an offer:
(the % of discount, the effective start date, the effective end date of the offer).

Refere to this link to imitate product details page
https://www.amazon.com/Carat-Genuine-Emerald-Diamond-Yellow/dp/B01J66XXY8/ref=lp_155
61026011_1_1?s=apparel&ie=UTF8&qid=1489431649&sr=1-1&nodeID=15561026011#technic
alSpecifications_feature_div


5- Shopping Card & Wish list pages

A) For the Shopping card the added products should be listed, with their detailed pricing
structure to show the origin price of each item, the discounts applied based on the offers
set and the total net price with text box to be filled with discount coupon and a Purchase
button on click it send a mail to the user’s email he used in registration with a bill
contains the products he have purchased and the prices.

B) For the Wish list it should contains only the added items with the ability to remove an
item from the wish list.

6- Statistics page ​:

For each product there should be a statistics button that on click It is a should display 3
information

A) The number of users who purchased this product .

B) The amount of money gained from this product

C) The top purchased product from the category that this product belongs to.

For Admin Area used this theme:

https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#download
