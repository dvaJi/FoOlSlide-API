"use strict";

module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.bulkInsert(
      "works_descriptions",
      [
        {
          workId: 1,
          language: "es",
          description: "Descripción en español.",
          createdAt: new Date(),
          updatedAt: new Date()
        },
        {
          workId: 1,
          language: "en",
          description: "English description.",
          createdAt: new Date(),
          updatedAt: new Date()
        }
      ],
      {}
    );
  },

  down: (queryInterface, Sequelize) => {
    return queryInterface.bulkDelete("works_descriptions", null, {});
  }
};
