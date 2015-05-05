@user
Feature: Registration, Login and Restore password for user

  Scenario: A new user successful registration
    Given I am on "/registration"
    When I fill in "identifier" with "behat@behat.no"
    And I fill in "password" with "123qwe"
    And I fill in "identical" with "123qwe"
    And I press "Registration"
    Then I should see "User registered"

  Scenario: User to successful login
    Given I am on "/login"
    When I fill in "identifier" with "behat@behat.no"
    And I fill in "password" with "123qwe"
    And I press "Login"
    Then I should see "User logged in"
    And I should see "behat@behat.no"
    And I should see "Logout"