Feature: Product basket
  In order to buy products
  As a customer
  I need to be able to put interesting products into a basket

Scenario: add a product to the product basket
  Given I am on the "Commander" page
  When I click "Ajouter"
  Then I should see the product in my product basket


