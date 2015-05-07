@user
Feature: Registration, Login and Restore password for user

  Background: Setup default roles
    Given There are following roles:
      | id | parent_id | name  |
      | 1  | 1         | guest |
      | 2  | 1         | user  |
      | 3  | 3         | admin |

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