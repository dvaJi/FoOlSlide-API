'use strict';

// WorksCovers
export default function(sequelize, DataTypes) {
  let WorksCovers = sequelize.define('works_covers', {
    filename: {
      type: DataTypes.STRING
    },
    coverTypeId: {
      type: DataTypes.INTEGER
    },
    hidden: {
      type: DataTypes.BOOLEAN
    },
    height: {
      type: DataTypes.INTEGER
    },
    width: {
      type: DataTypes.INTEGER
    },
    size: {
      type: DataTypes.INTEGER
    },
    mime: {
      type: DataTypes.STRING
    }
  });

  WorksCovers.associate = function(models) {
    WorksCovers.belongsTo(models.Works);
  };

  return WorksCovers;
}
