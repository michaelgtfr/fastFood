Feature: product basket
  In order to purchase products
  As a customer
  I need to be able to validate my product basket and give additional information about the order

  @javascript
  Scenario: see the summary of the products and the additional information form
    Given After validating my shopping cart
    Then I must see written on the page "Récapitulatif de la commande"