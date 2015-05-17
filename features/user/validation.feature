@user @validation
Feature: Check validation errors
  In order to check validation errors in follow user's forms: registration/login/forgot/restore
  As a user and guest
  I need fill forms with fake data

  Scenario: There is a registration page
    Given I am on "/registration"
    Then the response status code should be 200
    And I should see an "input[name=identifier]" element
    And I should see an "input[name=password]" element
    And I should see an "input[name=identical]" element
    And I should see an "input[type=submit]" element

  Scenario: User register with empty fields
    Given I am on "/registration"
    When I fill in "identifier" with ""
    And I fill in "password" with ""
    And I fill in "identical" with ""
    And I press "send"
    Then I should see "Value is required" in the "#field-identifier div" element
    And I should see "Value is required" in the "#field-password div" element
    And I should see "Value is required" in the "#field-identical div" element

  Scenario: User register with an invalid email type
    Given I am on "/registration"
    When I fill in "identifier" with "test"
    And I press "send"
    Then I should see "The input is not a valid email address" in the "#field-identifier div" element

  Scenario: User register with different passwords
    Given I am on "/registration"
    When I fill in "password" with "pass1"
    And I fill in "identical" with "pass2"
    And I press "send"
    Then I should see "Passwords not match" in the "#field-identical div" element

  Scenario: There is a login page
    Given I am on "/login"
    Then the response status code should be 200
    And I should see an "input[name=identifier]" element
    And I should see an "input[name=password]" element
    And I should see an "input[type=submit]" element
    And I should see "Forgot password" in the "#link-forgot" element

  Scenario: User login with empty fields
    Given I am on "/login"
    When I fill in "identifier" with ""
    And I fill in "password" with ""
    And I press "send"
    Then I should see "Value is required" in the "#field-identifier div" element
    And I should see "Value is required" in the "#field-password div" element

  Scenario: User login with an invalid email type
    Given I am on "/login"
    When I fill in "identifier" with "test"
    And I press "send"
    Then I should see "The input is not a valid email address" in the "#field-identifier div" element

  Scenario: User not found on the login page
    Given I am on "/login"
    When I fill in "identifier" with "behat.test@test.no"
    And I fill in "password" with "password"
    And I press "send"
    Then I should see "A user account not be found or disable"

  Scenario: There is a forgot page
    Given I am on "/forgot"
    Then the response status code should be 200
    And I should see an "input[name=identifier]" element
    And I should see an "input[type=submit]" element

  Scenario: User restore a password on forgot page with an empty email
    Given I am on "/forgot"
    When I fill in "identifier" with ""
    And I press "send"
    Then I should see "Value is required" in the "#field-identifier div" element

  Scenario: User restore a password on forgot page with an invalid email type
    Given I am on "/forgot"
    When I fill in "identifier" with "test"
    And I press "send"
    Then I should see "The input is not a valid email address" in the "#field-identifier div" element

  Scenario: User not found on a forgot page
    Given I am on "/forgot"
    When I fill in "identifier" with "behat.test@test.no"
    And I press "send"
    Then I should see "A user with this email not exists" in the "#field-identifier div" element

  Scenario: Hash is not have 40 chars
    Given I am on "/restore/t0"
    Then the response status code should be 404

  Scenario: Restore page allow hash with chars and digits
    Given I am on "/restore/012345678901234567890123456789qwerty<br>"
    Then the response status code should be 404

  Scenario: There is a restore page
    Given I am on "/restore/012345678901234567890123456789qwertyuiop"
    Then I should see an "input[name=password]" element
    And I should see an "input[name=identical]" element
    And I should see an "input[type=submit]" element

  Scenario: Temporary hash not found on a restore page and passwords are empty
    Given I am on "/restore/012345678901234567890123456789qwertyuiop"
    When I press "send"
    Then I should see "Hash is wrong"
    And I should see "Value is required" in the "#field-password div" element
    And I should see "Value is required" in the "#field-identical div" element

  Scenario: Passwords are different on a restore page
    Given I am on "/restore/012345678901234567890123456789qwertyuiop"
    When I fill in "password" with "pass1"
    And I fill in "identical" with "pass2"
    And I press "send"
    Then I should see "Passwords not match" in the "#field-identical div" element