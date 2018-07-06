'use strict';

const params = require('../config/params');

module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.bulkInsert(
      'works_genres',
      [
        {
          workId: 2,
          genreId: params.genres.types.action.id,
          createdAt: new Date(),
          updatedAt: new Date()
        },
        {
          workId: 2,
          genreId: params.genres.types.ecchi.id,
          createdAt: new Date(),
          updatedAt: new Date()
        },
        {
          workId: 2,
          genreId: params.genres.types.supernatural.id,
          createdAt: new Date(),
          updatedAt: new Date()
        }
      ],
      {}
    );
  },

  down: (queryInterface, Sequelize) => {
    return queryInterface.bulkDelete('works_descriptions', null, {});
  }
};
