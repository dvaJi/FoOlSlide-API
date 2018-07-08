module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable('chapters', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      workId: {
        type: Sequelize.INTEGER,
        references: {
          model: 'works',
          key: 'id'
        },
        allowNull: false
      },
      chapter: {
        type: Sequelize.INTEGER
      },
      subchapter: {
        type: Sequelize.INTEGER
      },
      volume: {
        type: Sequelize.INTEGER
      },
      language: {
        type: Sequelize.STRING
      },
      name: {
        type: Sequelize.STRING
      },
      stub: {
        type: Sequelize.STRING
      },
      uniqid: {
        type: Sequelize.STRING
      },
      hidden: {
        type: Sequelize.BOOLEAN
      },
      description: {
        type: Sequelize.TEXT
      },
      thumbnail: {
        type: Sequelize.TEXT
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE
      }
    });
  },
  down: queryInterface => {
    return queryInterface.dropTable('chapters');
  }
};
