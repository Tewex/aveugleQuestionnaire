using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace TravailLundiAprem
{
    public partial class AddQuestion : Form
    {
        public string Question { get => Question; set => Question = value; }
        public string Answer { get => Answer; set => Answer = value; }
        public Image Img { get => Img; set => Img = value; }
        public AddQuestion()
        {
            InitializeComponent();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (openFileDialog1.ShowDialog() == DialogResult.OK)
            {
                Img = Image.FromFile(openFileDialog1.FileName);
            }

        }
    }
}
