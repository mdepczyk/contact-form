@form
Feature: Send contact form data

    Scenario: Send proper data
        Given the following multipart form parameters are set:
          | name | value |
          | name | john |
          | email | john@example.com |
          | message | test message |
        When I request "/api/v1/form/send" using HTTP "POST"
        Then the response code is 201

    Scenario: Send invalid data
      Given the following multipart form parameters are set:
        | name | value |
        | name | john |
        | email | john |
        | message | test message |
      When I request "/api/v1/form/send" using HTTP "POST"
      Then the response code is 400

