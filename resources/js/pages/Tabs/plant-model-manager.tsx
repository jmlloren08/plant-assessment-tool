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
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import Swal from 'sweetalert2';
import { Pencil, Trash2 } from "lucide-react";

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

interface PlantModelFormData {
  name: string;
  description: string;
  plant_make_id: string;
  [key: string]: string; // Add index signature for Inertia compatibility
}

interface PlantModelManagerProps {
  plantModels: PlantModel[];
  plantMakes: PlantMake[];
}

export default function PlantModelManager({ plantModels, plantMakes }: PlantModelManagerProps) {
  const [open, setOpen] = useState<boolean>(false);
  const [formData, setFormData] = useState<PlantModelFormData>({
    name: "",
    description: "",
    plant_make_id: "",
  });
  const [editId, setEditId] = useState<string | null>(null);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (editId) {
      router.put(`/plant-management/models/${editId}`, formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ name: "", description: "", plant_make_id: "" });
          setEditId(null);
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Plant model updated successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          console.error('Update failed:', errors);
          const errorMessage = errors?.name
            ? `Name ${errors.name}`
            : 'Failed to update plant model';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    } else {
      router.post("/plant-management/models", formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ name: "", description: "", plant_make_id: "" });
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Plant model created successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          console.error('Create failed:', errors);
          const errorMessage = errors?.name
            ? `Name ${errors.name}`
            : 'Failed to create plant model';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    }
  };

  const handleEdit = (model: PlantModel) => {
    setFormData({
      name: model.name,
      description: model.description || "",
      plant_make_id: model.make_id,
    });
    setEditId(model.id);
    setOpen(true);
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
    }).then((result: { isConfirmed: boolean }) => {
      if (result.isConfirmed) {
        router.delete(`/plant-management/models/${id}`, {
          onSuccess: () => {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Plant model deleted successfully',
              timer: 2000,
            });
          },
          onError: (errors) => {
            console.error('Delete failed:', errors);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Failed to delete plant model'
            });
          },
        });
      }
    });
  };

  return (
    <div className="space-y-4">
      <div className="flex justify-between items-center">
        <h2 className="text-lg font-semibold">Plant Models</h2>
        <Dialog open={open} onOpenChange={setOpen}>
          <DialogTrigger asChild>
            <Button
              onClick={() => {
                setFormData({ name: "", description: "", plant_make_id: "" });
                setEditId(null);
              }}
            >
              Add New Model
            </Button>
          </DialogTrigger>
          <DialogContent aria-describedby="dialog-description">
            <DialogHeader>
              <DialogTitle>
                {editId ? "Edit Plant Model" : "Add New Plant Model"}
              </DialogTitle>
              <p id="dialog-description" className="text-sm text-muted-foreground">
                {editId ? "Update the details of this plant model." : "Create a new plant model by filling out the form below."}
              </p>
            </DialogHeader>
            <form onSubmit={handleSubmit} className="space-y-4">
              <div className="space-y-2">
                <Label htmlFor="plant_make_id">Make</Label>
                <Select
                  value={formData.plant_make_id}
                  onValueChange={(value) => setFormData({ ...formData, plant_make_id: value })}
                  required
                >
                  <SelectTrigger>
                    <SelectValue placeholder="Select a make" />
                  </SelectTrigger>
                  <SelectContent>
                    {plantMakes.map((make) => (
                      <SelectItem key={make.id} value={make.id}>
                        {make.name}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
              <div className="space-y-2">
                <Label htmlFor="name">Name</Label>
                <Input
                  autoFocus
                  id="name"
                  value={formData.name}
                  onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                    setFormData({ ...formData, name: e.target.value })
                  }
                  required
                />
              </div>
              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  value={formData.description}
                  onChange={(e: React.ChangeEvent<HTMLTextAreaElement>) =>
                    setFormData({ ...formData, description: e.target.value })
                  }
                />
              </div>
              <div className="flex justify-end gap-2">
                <Button type="button" variant="secondary" onClick={() => setOpen(false)}>
                  Cancel
                </Button>
                <Button type="submit">
                  {editId ? "Update" : "Create"}
                </Button>
              </div>
            </form>
          </DialogContent>
        </Dialog>
      </div>

      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Make</TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Description</TableHead>
            <TableHead className="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          {plantModels.length === 0 ? (
            <TableRow>
              <TableCell colSpan={4} className="text-center text-muted-foreground">
                No plant models found.
              </TableCell>
            </TableRow>
          ) : (
            plantModels.map((model) => (
              <TableRow key={model.id}>
                <TableCell>{model.make.name}</TableCell>
                <TableCell>{model.name}</TableCell>
                <TableCell className="truncate max-w-xs" title={model.description}>
                  {model.description}
                </TableCell>
                <TableCell className="text-right space-x-2">
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={() => handleEdit(model)}
                  >
                    <Pencil />
                  </Button>
                  <Button
                    variant="destructive"
                    size="sm"
                    onClick={() => handleDelete(model.id)}
                  >
                    <Trash2 />
                  </Button>
                </TableCell>
              </TableRow>
            ))
          )}
        </TableBody>
      </Table>
    </div>
  );
} 