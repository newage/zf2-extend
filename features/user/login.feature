@user
Feature: Login
  Login user use main authentication

  Scenario: Showing login form without errors
    Given I am on "/login"
    Then I should see "Login user"

  @javascript
  Scenario: Showing login form with email error
    Given I am on "/login"
    When I fill in "identifier" with "test"
    And I press "Login"
    Then I should see "The input is not a valid email address"