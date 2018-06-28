"use strict";

const params = require('../config/params');

module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.bulkInsert(
      "works",
      [
        {
          name: "Senpai, Sore Hitokuchi Kudasai!",
          stub: "senpai_sore_hitokuchi_kudasai",
          uniqid: "56ff02b19f342",
          hidden: false,
          type: "Manga",
          author: "Mizu Asato",
          artist: "Mizu Asato",
          status: params.works.status.onGoing.id,
          statusReason: null,
          thumbnail: "coverImage_1861918.jpg",
          adult: false,
          visits: 1000,
          createdAt: new Date(),
          updatedAt: new Date()
        }
      ],
      {}
    );
  },

  down: (queryInterface, Sequelize) => {
    return queryInterface.bulkDelete("works", null, {});
  }
};
