// App Imports
import params from '../../config/params';
import models from '../../setup/models';

// Get pages by chapter
export async function getByChapter(parentValue, { chapterId }) {
  return await models.Page.findAll({
    where: {
      chapterId: chapterId
    },
    include: [{ model: models.Chapter, as: 'chapter' }]
  });
}

// Create page
export async function create(
  parentValue,
  { chapterId, filename, hidden, height, width, size, mime },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.Page.create({
      chapterId,
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

// Update page
export async function update(
  parentValue,
  { id, chapterId, filename, hidden, height, width, size, mime },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.Page.update(
      {
        chapterId,
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

// Delete page
export async function remove(parentValue, { id }, { auth }) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    const page = await models.Page.findOne({ where: { id } });

    if (!page) {
      // Page does not exists
      throw new Error('The page does not exists.');
    } else {
      return await models.Page.destroy({ where: { id } });
    }
  } else {
    throw new Error('Operation denied.');
  }
}

// Page types
export async function getTypes() {
  return Object.values(params.page.types);
}
