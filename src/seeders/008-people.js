'use strict';

module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.bulkInsert(
      'peoples',
      [
        {
          name: 'Asato Mizu',
          name_kanji: '水あさと',
          stub: 'asato-mizu',
          uniqid: '9asd0sdf9s',
          description: 'Círculo: Milmake Orange (ミルメークオレンジ)',
          twitter: 'mizuasato',
          thumbnail: null,
          createdAt: new Date(),
          updatedAt: new Date()
        }
      ],
      {}
    );
  },

  down: (queryInterface, Sequelize) => {
    return queryInterface.bulkDelete('peoples', null, {});
  }
};
