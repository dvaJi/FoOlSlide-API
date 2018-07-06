// Imports
import Sequelize from 'sequelize';

// App Imports
import databaseConnection from './database';

const models = {
  User: databaseConnection.import('../modules/user/model'),
  PeopleWorks: databaseConnection.import('../modules/people-works/model'),
  People: databaseConnection.import('../modules/people/model'),
  Page: databaseConnection.import('../modules/page/model'),
  WorksGenres: databaseConnection.import('../modules/works-genre/model'),
  WorksDescription: databaseConnection.import(
    '../modules/works-description/model'
  ),
  WorksCovers: databaseConnection.import('../modules/works-cover/model'),
  Works: databaseConnection.import('../modules/works/model'),
  Chapter: databaseConnection.import('../modules/chapter/model')
};

Object.keys(models).forEach(modelName => {
  if (models[modelName].associate) {
    models[modelName].associate(models);
  }
});

models.sequelize = databaseConnection;
models.Sequelize = Sequelize;

export default models;
