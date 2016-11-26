<?php
use Picamator\NeoWsClient\Model\Api\Data\NeoInterface;

/**
 * Show neo detailed
 *
 * @param NeoInterface $data
 */
function showNeoDetailed(NeoInterface $data)
{
    echo <<<EOT
{$data->getName()}
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Neo reference id                | {$data->getNeoReferenceId()}
Name                            | {$data->getName()}
NASA JPL url                    | {$data->getNasaJplUrl()}
Link                            | {$data->getLink()->getSelf()}
Absolute magnitude H            | {$data->getAbsoluteMagnitudeH()}
Potentially hazardous asteroid  | {$data->hasPotentiallyHazardousAsteroid()}


Estimated diameter
------------------

Kilometers (min)                | {$data->getEstimatedDiameter()->getKilometers()->getEstimatedDiameterMin()} 
Kilometers (max)                | {$data->getEstimatedDiameter()->getKilometers()->getEstimatedDiameterMax()}
------------------------------- | -----------------------
Meters (min)                    | {$data->getEstimatedDiameter()->getMeters()->getEstimatedDiameterMin()} 
Meters (max)                    | {$data->getEstimatedDiameter()->getMeters()->getEstimatedDiameterMax()}
------------------------------- | -----------------------
Miles (min)                     | {$data->getEstimatedDiameter()->getMiles()->getEstimatedDiameterMin()} 
Miles (max)                     | {$data->getEstimatedDiameter()->getMiles()->getEstimatedDiameterMax()}
------------------------------- | -----------------------
Feet (min)                      | {$data->getEstimatedDiameter()->getFeet()->getEstimatedDiameterMin()} 
Feet (max)                      | {$data->getEstimatedDiameter()->getFeet()->getEstimatedDiameterMax()}


Orbital data
------------

Orbit id                        | {$data->getOrbitalData()->getOrbitId()} 
Orbit determination date        | {$data->getOrbitalData()->getOrbitDeterminationDate()->format('Y-m-d H:i:s')} 
Orbit uncertainty               | {$data->getOrbitalData()->getOrbitUncertainty()} 
Minimum orbit intersection      | {$data->getOrbitalData()->getMinimumOrbitIntersection()} 
Jupiter Tisserand's invariant   | {$data->getOrbitalData()->getJupiterTisserandInvariant()} 
Epoch osculation                | {$data->getOrbitalData()->getEpochOsculation()} 
Eccentricity                    | {$data->getOrbitalData()->getEccentricity()} 
Semi major axis                 | {$data->getOrbitalData()->getSemiMajorAxis()} 
Inclination                     | {$data->getOrbitalData()->getInclination()} 
Ascending node longitude        | {$data->getOrbitalData()->getAscendingNodeLongitude()} 
Orbital period                  | {$data->getOrbitalData()->getOrbitalPeriod()} 
Perihelion distance             | {$data->getOrbitalData()->getPerihelionDistance()} 
Perihelion argument             | {$data->getOrbitalData()->getPerihelionArgument()} 
Aphelion distance               | {$data->getOrbitalData()->getAphelionDistance()} 
Perihelion time                 | {$data->getOrbitalData()->getPerihelionTime()} 
Mean anomaly                    | {$data->getOrbitalData()->getMeanAnomaly()} 
Mean motion                     | {$data->getOrbitalData()->getMeanMotion()} 
Equinox                         | {$data->getOrbitalData()->getEquinox()} 


Close approach data
-------------------

EOT;

    /** @var \Picamator\NeoWsClient\Model\Data\Component\CloseApproach $item */
    foreach ($data->getCloseApproachData() as $item) {

        echo <<<EOT
Close approach date             | {$item->getCloseApproachDate()->format('Y-m-d')} 
Epoch date close approach       | {$item->getEpochDateCloseApproach()} 
Orbiting body                   | {$item->getOrbitingBody()} 
------------------------------- | -------------------------------
Relative velocity               | 
------------------------------- | -------------------------------
Kilometers per second           | {$item->getRelativeVelocity()->getKilometersPerSecond()}
Kilometers per hour             | {$item->getRelativeVelocity()->getKilometersPerHour()}
Miles per hour                  | {$item->getRelativeVelocity()->getMilesPerHour()}
------------------------------- | -------------------------------
Miss distance                   | 
------------------------------- | -------------------------------
Astronomical                    | {$item->getMissDistance()->getAstronomical()}
Lunar                           | {$item->getMissDistance()->getLunar()}
Kilometers                      | {$item->getMissDistance()->getKilometers()}
Miles                           | {$item->getMissDistance()->getMiles()}
=================================================================


EOT;

    }
}