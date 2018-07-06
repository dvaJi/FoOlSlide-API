// App Imports
import params from '../../config/params';
import models from '../../setup/models';

// Get all works
export async function getAll(
  parentValue,
  { language, orderBy, first, offset }
) {
  return await models.Works.findAll({
    order: [['id', orderBy]],
    offset: offset,
    limit: first,
    include: [
      {
        model: models.Chapter,
        as: 'chapters',
        include: [{ model: models.Page, as: 'pages' }]
      },
      {
        model: models.WorksDescription,
        as: 'works_descriptions',
        where: { language }
      },
      {
        model: models.WorksCovers
      },
      {
        model: models.WorksGenres
      },
      {
        model: models.PeopleWorks,
        as: 'people_works',
        include: [{ model: models.People }]
      }
    ]
  });
}

// Get works by stub
export async function getByStub(parentValue, { stub, language }) {
  const works = await models.Works.findOne({
    where: { stub },
    include: [
      {
        model: models.Chapter,
        as: 'chapters',
        include: [{ model: models.Page, as: 'pages' }]
      },
      {
        model: models.WorksDescription,
        as: 'works_descriptions',
        where: { language }
      },
      {
        model: models.WorksCovers
      },
      {
        model: models.WorksGenres
      },
      {
        model: models.PeopleWorks,
        as: 'people_works',
        include: [{ model: models.People }]
      }
    ]
  });

  if (!works) {
    // Works does not exists
    throw new Error('The works you are looking for does not exists.');
  } else {
    return works;
  }
}

// Get works by ID
export async function getById(parentValue, { workId, language }) {
  const works = await models.Works.findOne({
    where: { id: workId },
    include: [
      {
        model: models.WorksDescription,
        as: 'works_descriptions',
        where: { language }
      },
      {
        model: models.Chapter,
        as: 'chapters',
        include: [{ model: models.Page, as: 'pages' }]
      },
      {
        model: models.WorksCovers
      },
      {
        model: models.WorksGenres
      },
      {
        model: models.PeopleWorks,
        as: 'people_works',
        include: [{ model: models.People }]
      }
    ]
  });

  if (!works) {
    // Works does not exists
    throw new Error('The works you are looking for does not exists.');
  } else {
    return works;
  }
}

// Get random work
export async function getRandom(parentValue, { language }) {
  return await models.Works.findOne({
    limit: 1,
    order: [[models.Sequelize.fn('RAND')]],
    include: [
      {
        model: models.WorksDescription,
        as: 'works_descriptions',
        where: { language }
      },
      {
        model: models.Chapter,
        as: 'chapters',
        include: [{ model: models.Page, as: 'pages' }]
      },
      {
        model: models.WorksCovers
      },
      {
        model: models.WorksGenres
      },
      {
        model: models.PeopleWorks,
        as: 'people_works',
        include: [{ model: models.People }]
      }
    ]
  });
}

// Create works
export async function create(
  parentValue,
  {
    name,
    stub,
    uniqid,
    type,
    hidden,
    demographicId,
    status,
    statusReason,
    description,
    adult,
    visits
  },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.Works.create({
      name,
      stub,
      uniqid,
      type,
      hidden,
      demographicId,
      status,
      statusReason,
      description,
      adult,
      visits
    });
  } else {
    throw new Error('Operation denied.');
  }
}

// Update works
export async function update(
  parentValue,
  {
    id,
    name,
    stub,
    uniqid,
    type,
    hidden,
    demographicId,
    status,
    statusReason,
    description,
    adult,
    visits
  },
  { auth }
) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    return await models.Works.update(
      {
        name,
        stub,
        uniqid,
        type,
        hidden,
        demographicId,
        status,
        statusReason,
        description,
        adult,
        visits
      },
      { where: { id } }
    );
  } else {
    throw new Error('Operation denied.');
  }
}

// Delete works
export async function remove(parentValue, { id }, { auth }) {
  if (auth.user && auth.user.role === params.user.roles.admin) {
    const works = await models.Works.findOne({ where: { id } });

    if (!works) {
      // Works does not exists
      throw new Error('The works does not exists.');
    } else {
      return await models.Works.destroy({ where: { id } });
    }
  } else {
    throw new Error('Operation denied.');
  }
}

// Works Status types
export async function getStatusTypes() {
  return Object.values(params.works.status);
}
