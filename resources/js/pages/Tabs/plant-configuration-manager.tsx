import { useState } from "react";
import { router } from "@inertiajs/react";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Pencil, Trash2 } from "lucide-react";
import Swal from "sweetalert2";

interface PlantConfiguration {
  id: string;
  name: string;
  description?: string;
}

interface PlantConfigurationFormData {
  name: string;
  description: string;
  [key: string]: string; // Add index signature for Inertia compatibility
}

interface PageProps {
  plantConfigurations: PlantConfiguration[];
}

export default function PlantConfigurationManager({ plantConfigurations }: PageProps) {
  const [isOpen, setIsOpen] = useState(false);
  const [isEditing, setIsEditing] = useState(false);
  const [formData, setFormData] = useState<PlantConfigurationFormData>({
    name: "",
    description: "",
  });
  const [editingId, setEditingId] = useState<string | null>(null);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    if (isEditing && editingId) {
      router.put(`/plant-management/configurations/${editingId}`, formData, {
        onSuccess: () => {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Configuration updated successfully',
            timer: 2000,
          });
          setIsOpen(false);
          resetForm();
        },
        onError: (errors) => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to update configuration',
            timer: 2000,
          });
        },
      });
    } else {
      router.post("/plant-management/configurations", formData, {
        onSuccess: () => {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Configuration created successfully',
            timer: 2000,
          });
          setIsOpen(false);
          resetForm();
        },
        onError: (errors) => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to create configuration',
            timer: 2000,
          });
        },
      });
    }
  };

  const handleEdit = (configuration: PlantConfiguration) => {
    setFormData({
      name: configuration.name,
      description: configuration.description || "",
    });
    setEditingId(configuration.id);
    setIsEditing(true);
    setIsOpen(true);
  };

  const handleDelete = (id: string) => {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        router.delete(`/plant-management/configurations/${id}`, {
          onSuccess: () => {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Configuration deleted successfully',
              timer: 2000,
            });
          },
          onError: () => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Failed to delete configuration',
              timer: 2000,
            });
          },
        });
      }
    });
  };

  const resetForm = () => {
    setFormData({
      name: "",
      description: "",
    });
    setEditingId(null);
    setIsEditing(false);
  };

  return (
    <div className="space-y-4">
      <div className="flex justify-between items-center">
        <h2 className="text-xl font-semibold">Plant Configurations</h2>
        <Dialog open={isOpen} onOpenChange={setIsOpen}>
          <DialogTrigger asChild>
            <Button onClick={() => {
              resetForm();
              setIsOpen(true);
            }}>
              Add Configuration
            </Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>
                {isEditing ? "Edit Configuration" : "Add Configuration"}
              </DialogTitle>
            </DialogHeader>
            <form onSubmit={handleSubmit} className="space-y-4">
              <div className="space-y-2">
                <label htmlFor="name" className="text-sm font-medium">
                  Name
                </label>
                <Input
                  id="name"
                  value={formData.name}
                  onChange={(e) =>
                    setFormData({ ...formData, name: e.target.value })
                  }
                  required
                />
              </div>
              <div className="space-y-2">
                <label htmlFor="description" className="text-sm font-medium">
                  Description
                </label>
                <Textarea
                  id="description"
                  value={formData.description}
                  onChange={(e) =>
                    setFormData({ ...formData, description: e.target.value })
                  }
                />
              </div>
              <div className="flex justify-end space-x-2">
                <Button
                  type="button"
                  variant="outline"
                  onClick={() => {
                    setIsOpen(false);
                    resetForm();
                  }}
                >
                  Cancel
                </Button>
                <Button type="submit">
                  {isEditing ? "Update" : "Create"}
                </Button>
              </div>
            </form>
          </DialogContent>
        </Dialog>
      </div>

      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Name</TableHead>
            <TableHead>Description</TableHead>
            <TableHead className="w-[100px]">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          {plantConfigurations.map((configuration) => (
            <TableRow key={configuration.id}>
              <TableCell>{configuration.name}</TableCell>
              <TableCell className="truncate max-w-xs" title={configuration.description}>
                {configuration.description}
              </TableCell>
              <TableCell>
                <div className="flex space-x-2">
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={() => handleEdit(configuration)}
                  >
                    <Pencil />
                  </Button>
                  <Button
                    variant="destructive"
                    size="sm"
                    onClick={() => handleDelete(configuration.id)}
                  >
                    <Trash2 />
                  </Button>
                </div>
              </TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </div>
  );
} 