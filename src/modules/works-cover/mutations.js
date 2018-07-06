// Imports
import { GraphQLString, GraphQLInt, GraphQLBoolean } from 'graphql';

// App Imports
import { WorksCoverType } from './types';
import { create, update, remove } from './resolvers';

// WorksCover create
export const worksCoverCreate = {
  type: WorksCoverType,
  args: {
    workId: {
      name: 'workId',
      type: GraphQLInt
    },

    filename: {
      name: 'filename',
      type: GraphQLString
    },

    coverTypeId: {
      name: 'coverTypeId',
      type: GraphQLInt
    },

    hidden: {
      name: 'hidden',
      type: GraphQLBoolean
    },

    height: {
      name: 'height',
      type: GraphQLInt
    },

    width: {
      name: 'width',
      type: GraphQLInt
    },

    size: {
      name: 'size',
      type: GraphQLInt
    },

    mime: {
      name: 'mime',
      type: GraphQLString
    }
  },
  resolve: create
};

// WorksCover update
export const worksCoverUpdate = {
  type: WorksCoverType,
  args: {
    id: {
      name: 'id',
      type: GraphQLInt
    },

    workId: {
      name: 'workId',
      type: GraphQLInt
    },

    filename: {
      name: 'filename',
      type: GraphQLString
    },

    coverTypeId: {
      name: 'coverTypeId',
      type: GraphQLInt
    },

    hidden: {
      name: 'hidden',
      type: GraphQLBoolean
    },

    height: {
      name: 'height',
      type: GraphQLInt
    },

    width: {
      name: 'width',
      type: GraphQLInt
    },

    size: {
      name: 'size',
      type: GraphQLInt
    },

    mime: {
      name: 'mime',
      type: GraphQLString
    }
  },
  resolve: update
};

// WorksCover remove
export const worksCoverRemove = {
  type: WorksCoverType,
  args: {
    id: {
      name: 'id',
      type: GraphQLInt
    }
  },
  resolve: remove
};
