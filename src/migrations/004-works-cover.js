module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable('works_covers', {
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
      filename: {
        type: Sequelize.STRING
      },
      coverTypeId: {
        type: Sequelize.INTEGER
      },
      hidden: {
        type: Sequelize.BOOLEAN
      },
      height: {
        type: Sequelize.INTEGER
      },
      width: {
        type: Sequelize.INTEGER
      },
      size: {
        type: Sequelize.INTEGER
      },
      mime: {
        type: Sequelize.STRING
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
    return queryInterface.dropTable('works_covers');
  }
};
