// App Imports
import params from '../../config/params';
import models from '../../setup/models';

// Get WorksCovers by Work
export async function getByWork(parentValue, { workId }) {
  return await models.WorksCovers.findAll({
    where: {
      workId
    },
    include: [{ model: models.Works, as: 'work' }]
  });
}

// Create WorksCovers
export async function create(
  parentValue,
  { workId, filename, hidden, height, width, size, mime },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.WorksCovers.create({
      workId,
      filename,
      hidden,
      height,
      width,
      size,
      mime
    });
  } else {
    throw new Error('Operation denied.');
  }
}

// Update WorksCovers
export async function update(
  parentValue,
  { id, workId, filename, hidden, height, width, size, mime },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.WorksCovers.update(
      {
        workId,
        filename,
        hidden,
        height,
        width,
        size,
        mime
      },
      { where: { id } }
    );
  } else {
    throw new Error('Operation denied.');
  }
}

// Delete WorksCovers
export async function remove(parentValue, { id }, { auth }) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    const page = await models.WorksCovers.findOne({ where: { id } });

    if (!page) {
      // WorksCovers does not exists
      throw new Error('The WorksCovers does not exists.');
    } else {
      return await models.WorksCovers.destroy({ where: { id } });
    }
  } else {
    throw new Error('Operation denied.');
  }
}

// WorksCovers types
export async function getTypes() {
  return Object.values(params.works.cover_type);
}
