@checkout
Feature: Cart management

  Товары заказа сохраняются в сессии пользователя.
  Для каждого товара мы сохраняем id и quantity.
  Мы можем добавлять и удалять товар из корзины.

  Background:
    Given There are products:
      |id|name  |description           |price|
      | 1|mars 1|description for mars 1| 150 |
      | 2|mars 2|description for mars 2| 150 |
      | 3|mars 3|description for mars 3| 150 |

    And I have in my cart products:
      |id  |quantity|
      |1   |   1    |
      |2   |   2    |


  Scenario: I am on cart page

    Given I'm on cart page;
    Then  I should see 2 "tr.cart-product" elements


  Scenario: Add Product to Cart

    Given I'm on product page, product has id = "1";
    When I add product to cart;
    And I'm on cart page;
    Then I should have product in products list;


  Scenario: Remove Product from cart

    Given I'm on cart page;
    When I remove product with id = "1" from cart;
    Then I shouldn't have product with id = "1";