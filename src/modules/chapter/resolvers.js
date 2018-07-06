// App Imports
import params from '../../config/params';
import models from '../../setup/models';

// Get all chapters
export async function getAll(
  parentValue,
  { language, orderBy, first, offset }
) {
  return await models.Chapter.findAll({
    where: {
      language
    },
    order: [['id', orderBy]],
    include: [
      { model: models.Works, as: 'work' },
      { model: models.Page, as: 'pages' }
    ],
    offset: offset,
    limit: first
  });
}

// Get chapter by work
export async function getByWork(parentValue, { workId }) {
  return await models.Chapter.findAll({
    where: {
      workId: Number(workId),
      language
    },
    include: [
      { model: models.Works, as: 'work' },
      { model: models.Page, as: 'pages' }
    ]
  });
}

// Create chapter
export async function create(
  parentValue,
  {
    workId,
    chapter,
    subchapter,
    volume,
    language,
    name,
    stub,
    uniqid,
    hidden,
    description,
    thumbnail
  },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.Chapter.create({
      workId,
      chapter,
      subchapter,
      volume,
      language,
      name,
      stub,
      uniqid,
      hidden,
      description,
      thumbnail
    });
  } else {
    throw new Error('Operation denied.');
  }
}

// Update chapter
export async function update(
  parentValue,
  {
    id,
    workId,
    chapter,
    subchapter,
    volume,
    language,
    name,
    stub,
    uniqid,
    hidden,
    description,
    thumbnail
  },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.Chapter.update(
      {
        workId,
        chapter,
        subchapter,
        volume,
        language,
        name,
        stub,
        uniqid,
        hidden,
        description,
        thumbnail
      },
      { where: { id } }
    );
  } else {
    throw new Error('Operation denied.');
  }
}

// Delete chapter
export async function remove(parentValue, { id }, { auth }) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    const chapter = await models.Chapter.findOne({ where: { id } });

    if (!chapter) {
      // Chapter does not exists
      throw new Error('The chapter does not exists.');
    } else {
      return await models.Chapter.destroy({ where: { id } });
    }
  } else {
    throw new Error('Operation denied.');
  }
}

// Chapter types
export async function getTypes() {
  return Object.values(params.chapter.types);
}
