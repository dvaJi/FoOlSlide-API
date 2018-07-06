'use strict';

// Chapters
module.exports = function(sequelize, DataTypes) {
  let Chapters = sequelize.define('chapters', {
    chapter: {
      type: DataTypes.INTEGER
    },
    subchapter: {
      type: DataTypes.INTEGER
    },
    volume: {
      type: DataTypes.INTEGER
    },
    language: {
      type: DataTypes.STRING
    },
    name: {
      type: DataTypes.STRING
    },
    stub: {
      type: DataTypes.STRING
    },
    uniqid: {
      type: DataTypes.STRING
    },
    hidden: {
      type: DataTypes.BOOLEAN
    },
    description: {
      type: DataTypes.TEXT
    },
    thumbnail: {
      type: DataTypes.TEXT
    }
  });

  Chapters.associate = function(models) {
    Chapters.belongsTo(models.Works);
    Chapters.hasMany(models.Page);
  };

  return Chapters;
};
