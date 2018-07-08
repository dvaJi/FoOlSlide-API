// App Imports
import params from '../../config/params';

// Genres types
export async function getGenresTypes() {
  return Object.values(params.genres.types);
}

// Demographic types
export async function getDemographicTypes() {
  return Object.values(params.genres.demographic);
}
