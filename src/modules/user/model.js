'use strict';

// User
module.exports = function(sequelize, DataTypes) {
  let User = sequelize.define('users', {
    name: {
      type: DataTypes.STRING
    },
    email: {
      type: DataTypes.TEXT
    },
    password: {
      type: DataTypes.TEXT
    },
    role: {
      type: DataTypes.TEXT
    },
    activated: {
      type: DataTypes.BOOLEAN
    },
    banned: {
      type: DataTypes.BOOLEAN
    },
    lastIp: {
      type: DataTypes.STRING
    },
    lastLogin: {
      type: DataTypes.DATE
    }
  });

  return User;
};
