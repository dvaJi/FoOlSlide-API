'use strict';

const params = require('../config/params');

module.exports = {
  up: queryInterface => {
    return queryInterface.bulkInsert(
      'works_covers',
      [
        {
          workId: 2,
          filename: 'thumb_00_cover.png',
          coverTypeId: params.works.cover_type.small_thumb.id,
          hidden: false,
          height: params.works.cover_type.small_thumb.height,
          width: params.works.cover_type.small_thumb.width,
          size: 111,
          mime: 'png',
          createdAt: new Date(),
          updatedAt: new Date()
        },
        {
          workId: 2,
          filename: 'thumb2_00_cover.png',
          coverTypeId: params.works.cover_type.medium_thumb.id,
          hidden: false,
          height: params.works.cover_type.medium_thumb.height,
          width: params.works.cover_type.medium_thumb.width,
          size: 112,
          mime: 'png',
          createdAt: new Date(),
          updatedAt: new Date()
        },
        {
          workId: 2,
          filename: '00_cover.png',
          coverTypeId: params.works.cover_type.large_thumb.id,
          hidden: false,
          height: params.works.cover_type.large_thumb.height,
          width: params.works.cover_type.large_thumb.width,
          size: 112,
          mime: 'png',
          createdAt: new Date(),
          updatedAt: new Date()
        }
      ],
      {}
    );
  },

  down: queryInterface => {
    return queryInterface.bulkDelete('works_covers', null, {});
  }
};
