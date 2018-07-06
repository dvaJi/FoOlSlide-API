'use strict';

// Chapters
export default function(sequelize, DataTypes) {
  let WorksDescription = sequelize.define('works_descriptions', {
    language: {
      type: DataTypes.STRING
    },
    description: {
      type: DataTypes.TEXT
    }
  });

  WorksDescription.associate = function(models) {
    WorksDescription.belongsTo(models.Works);
  };

  return WorksDescription;
}
