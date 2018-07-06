// Imports
import { GraphQLString, GraphQLInt, GraphQLBoolean } from 'graphql';

// App Imports
import { WorkType } from './types';
import { create, update, remove } from './resolvers';

// Work create
export const workCreate = {
  type: WorkType,
  args: {
    name: {
      name: 'name',
      type: GraphQLString
    },

    stub: {
      name: 'stub',
      type: GraphQLString
    },

    uniqid: {
      name: 'uniqid',
      type: GraphQLString
    },

    type: {
      name: 'type',
      type: GraphQLString
    },

    hidden: {
      name: 'hidden',
      type: GraphQLBoolean
    },

    demographicId: {
      name: 'demographicId',
      type: GraphQLInt
    },

    status: {
      name: 'status',
      type: GraphQLInt
    },

    statusReason: {
      name: 'statusReason',
      type: GraphQLString
    },

    adult: {
      name: 'adult',
      type: GraphQLBoolean
    },

    visits: {
      name: 'visits',
      type: GraphQLInt
    }
  },
  resolve: create
};

// Work update
export const workUpdate = {
  type: WorkType,
  args: {
    id: {
      name: 'id',
      type: GraphQLInt
    },

    name: {
      name: 'name',
      type: GraphQLString
    },

    stub: {
      name: 'stub',
      type: GraphQLString
    },

    uniqid: {
      name: 'uniqid',
      type: GraphQLString
    },

    type: {
      name: 'type',
      type: GraphQLString
    },

    hidden: {
      name: 'hidden',
      type: GraphQLBoolean
    },

    demographicId: {
      name: 'demographicId',
      type: GraphQLInt
    },

    status: {
      name: 'status',
      type: GraphQLInt
    },

    statusReason: {
      name: 'statusReason',
      type: GraphQLString
    },

    thumbnail: {
      name: 'thumbnail',
      type: GraphQLString
    },

    adult: {
      name: 'adult',
      type: GraphQLBoolean
    },

    visits: {
      name: 'visits',
      type: GraphQLInt
    }
  },
  resolve: update
};

// Work remove
export const workRemove = {
  type: WorkType,
  args: {
    id: {
      name: 'id',
      type: GraphQLInt
    }
  },
  resolve: remove
};
