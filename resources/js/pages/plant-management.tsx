// filepath: d:\https github.com jmlloren08\plant-assessment-tool\resources\js\pages\plant-management.tsx
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import PlantTypeManager from "./Tabs/plant-type-manager";
import PlantMakeManager from "./Tabs/plant-make-manager";
import PlantModelManager from "./Tabs/plant-model-manager";
import PlantSerialRangeManager from "./Tabs/plant-serial-range-manager";
import PlantSerialNumberManager from "./Tabs/plant-serial-number-manager";
import PlantConfigurationManager from "./Tabs/plant-configuration-manager";
import AppLayout from "@/layouts/app-layout";
import { BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/react";
// import PlantSerialRangeManager from "./tabs/PlantSerialRangeManager";
// import PlantSerialNumberManager from "./tabs/PlantSerialNumberManager";
// import PlantConfigurationManager from "./tabs/PlantConfigurationManager";

interface PlantType {
  id: string;
  name: string;
  description?: string;
}

interface PlantMake {
  id: string;
  name: string;
  description?: string;
}

interface PlantModel {
  id: string;
  name: string;
  description?: string;
  make_id: string;
  make: PlantMake;
}

interface PlantSerialRange {
  id: string;
  prefix: string;
  description?: string;
  model_id: string;
  model: PlantModel;
}

interface PlantSerialNumber {
  id: string;
  serial_number: string;
  description?: string;
  serial_range_id: string;
  serial_range: PlantSerialRange;
}

interface PlantConfiguration {
  id: string;
  name: string;
  description?: string;
}

type TabValue = 'types' | 'makes' | 'models' | 'ranges' | 'serials' | 'configurations';

interface PlantManagementProps {
  plantTypes?: PlantType[];
  plantMakes?: PlantMake[];
  plantModels?: PlantModel[];
  plantSerialRanges?: PlantSerialRange[];
  plantSerialNumbers?: PlantSerialNumber[];
  plantConfigurations?: PlantConfiguration[];
}

export default function PlantManagement({
  plantTypes = [],
  plantMakes = [],
  plantModels = [],
  plantSerialRanges = [],
  plantSerialNumbers = [],
  plantConfigurations = []
}: PlantManagementProps) {
  const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Plant Management', href: '/plant-management' }
  ];

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Plant Management" />

      {/* Main content */}
      <div className="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 className="text-2xl font-bold mb-6">Plant Management</h1>

        <Tabs defaultValue="types" className="w-full">
          <TabsList className="grid w-full grid-cols-6 sm:w-auto sm:inline-grid sm:min-w-[400px]">
            <TabsTrigger value="types">Types</TabsTrigger>
            <TabsTrigger value="makes">Makes</TabsTrigger>
            <TabsTrigger value="models">Models</TabsTrigger>
            <TabsTrigger value="ranges">Serial Ranges</TabsTrigger>
            <TabsTrigger value="serials">Serial Numbers</TabsTrigger>
            <TabsTrigger value="configurations">Configurations</TabsTrigger>
          </TabsList>

          <div className="mt-6">
            <TabsContent value="types">
              <PlantTypeManager plantTypes={plantTypes} />
            </TabsContent>

            <TabsContent value="makes">
              <PlantMakeManager plantMakes={plantMakes} />
            </TabsContent>

            <TabsContent value="models">
              <PlantModelManager plantModels={plantModels} plantMakes={plantMakes} />
            </TabsContent>

            <TabsContent value="ranges">
              <PlantSerialRangeManager plantSerialRanges={plantSerialRanges} plantModels={plantModels} />
            </TabsContent>

            <TabsContent value="serials">
              <PlantSerialNumberManager plantSerialNumbers={plantSerialNumbers} plantSerialRanges={plantSerialRanges} />
            </TabsContent>

            <TabsContent value="configurations">
              <PlantConfigurationManager plantConfigurations={plantConfigurations} />
            </TabsContent>
          </div>
        </Tabs>
      </div>
    </AppLayout>
  );
}
