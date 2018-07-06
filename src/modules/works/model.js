'use strict';

// Works
module.exports = function(sequelize, DataTypes) {
  let Works = sequelize.define('works', {
    name: {
      type: DataTypes.STRING
    },
    stub: {
      type: DataTypes.STRING
    },
    uniqid: {
      type: DataTypes.STRING
    },
    type: {
      type: DataTypes.STRING
    },
    hidden: {
      type: DataTypes.BOOLEAN
    },
    demographicId: {
      type: DataTypes.INTEGER
    },
    status: {
      type: DataTypes.INTEGER
    },
    statusReason: {
      type: DataTypes.TEXT
    },
    adult: {
      type: DataTypes.BOOLEAN
    },
    visits: {
      type: DataTypes.INTEGER
    }
  });

  Works.associate = function(models) {
    Works.hasMany(models.Chapter);
    Works.hasMany(models.WorksDescription);
    Works.hasMany(models.PeopleWorks);
    Works.hasMany(models.WorksCovers);
    Works.hasMany(models.WorksGenres);
  };

  return Works;
};
