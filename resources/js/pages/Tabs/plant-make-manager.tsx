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
import Swal from 'sweetalert2';
import { Pencil, Trash2 } from "lucide-react";

interface PlantMake {
  id: string;
  name: string;
  description?: string;
}

interface PlantMakeFormData {
  name: string;
  description: string;
  [key: string]: string;
}

interface PlantMakeManagerProps {
  plantMakes: PlantMake[];
}

export default function PlantMakeManager({ plantMakes }: PlantMakeManagerProps) {
  const [open, setOpen] = useState<boolean>(false);
  const [formData, setFormData] = useState<PlantMakeFormData>({
    name: "",
    description: "",
  });
  const [editId, setEditId] = useState<string | null>(null);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (editId) {
      router.put(`/plant-management/makes/${editId}`, formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ name: "", description: "" });
          setEditId(null);
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Plant make updated successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          const errorMessage = errors?.name
            ? `Name ${errors.name}`
            : 'Failed to update plant make';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    } else {
      router.post("/plant-management/makes", formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ name: "", description: "" });
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Plant make created successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          const errorMessage = errors?.name
            ? `Name ${errors.name}`
            : 'Failed to create plant make';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    }
  };

  const handleEdit = (make: PlantMake) => {
    setFormData({
      name: make.name,
      description: make.description || "",
    });
    setEditId(make.id);
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
        router.delete(`/plant-management/makes/${id}`, {
          onSuccess: () => {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Plant make deleted successfully',
              timer: 2000,
            });
          },
          onError: (errors) => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Failed to delete plant make'
            });
          },
        });
      }
    });
  };

  return (
    <div className="space-y-4">
      <div className="flex justify-between items-center">
        <h2 className="text-lg font-semibold">Plant Makes</h2>
        <Dialog open={open} onOpenChange={setOpen}>
          <DialogTrigger asChild>
            <Button
              onClick={() => {
                setFormData({ name: "", description: "" });
                setEditId(null);
              }}
            >
              Add New Make
            </Button>
          </DialogTrigger>
          <DialogContent aria-describedby="dialog-description">
            <DialogHeader>
              <DialogTitle>
                {editId ? "Edit Plant Make" : "Add New Plant Make"}
              </DialogTitle>
              <p id="dialog-description" className="text-sm text-muted-foreground">
                {editId ? "Update the details of this plant make." : "Create a new plant make by filling out the form below."}
              </p>
            </DialogHeader>
            <form onSubmit={handleSubmit} className="space-y-4">
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
            <TableHead>Name</TableHead>
            <TableHead>Description</TableHead>
            <TableHead className="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          {plantMakes.length === 0 ? (
            <TableRow>
              <TableCell colSpan={3} className="text-center text-muted-foreground">
                No plant makes found.
              </TableCell>
            </TableRow>
          ) : (
            plantMakes.map((make) => (
              <TableRow key={make.id}>
                <TableCell>{make.name}</TableCell>
                <TableCell className="truncate max-w-xs" title={make.description}>
                  {make.description}
                </TableCell>
                <TableCell className="text-right space-x-2">
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={() => handleEdit(make)}
                  >
                    <Pencil />
                  </Button>
                  <Button
                    variant="destructive"
                    size="sm"
                    onClick={() => handleDelete(make.id)}
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