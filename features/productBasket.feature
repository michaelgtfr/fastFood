Feature: Product basket
  In order to buy products
  As a customer
  I need to be able to put interesting products into a basket

  @javascript
  Scenario: add a product to the product basket
    Given I am on the "/command" page
    And I must see written on the page "Les produits"
    When I click "Ajouter"
    Then I should see the product in my product basket

  @javascript
  Scenario: delete a product to the product basket
    Given I am on the "/command" page
    And I must see written on the page "Les produits"
    And I see the chosen product in the product basket
    When I click in the delete button of product
    Then I must no see the product in my product basket

  @javascript
  Scenario: presence of a product already in the shopping cart
    Given I come back to the order page after leaving it
    Then I should see else the product in my product basket

  @javascript
  Scenario: change the quantity of the chosen product
    Given I am on the "/command" page
    And I want "2" chosen product
    When I click "Ajouter"
    Then I should see "4" of the products in my product basket