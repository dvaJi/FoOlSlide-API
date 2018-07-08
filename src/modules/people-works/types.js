// Imports
import { GraphQLObjectType, GraphQLString, GraphQLInt } from 'graphql';

// App Imports
import { WorkType } from '../works/types';
import { PeopleType } from '../people/types';

// People type
const PeopleWorksType = new GraphQLObjectType({
  name: 'peopleWorks',
  description: 'PeopleWorks Type',

  fields: () => ({
    id: { type: GraphQLInt },
    work: { type: WorkType },
    people: { type: PeopleType },
    rol: { type: GraphQLInt },
    createdAt: { type: GraphQLString },
    updatedAt: { type: GraphQLString }
  })
});

export { PeopleWorksType };
