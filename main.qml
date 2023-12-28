import QtQuick 2.15
import QtQuick.Window 2.15
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.2

ApplicationWindow {
    width: 360
    height: 640
    visible: true

    property alias currentPage: stack_view.currentItem

    header: ToolBar {
        id: page_header
        height: 40
        RowLayout {
            anchors.fill: parent
            ToolButton {
                visible: stack_view.depth > 1
                text: qsTr("‹")
                onClicked: stack_view.pop()
            }
            Label {
                id: label
                text: "This is page1"
                elide: Label.ElideRight
                horizontalAlignment: Qt.AlignHCenter
                verticalAlignment: Qt.AlignVCenter
                Layout.fillWidth: true
            }
        }
    }

    StackView {
        id: stack_view
        anchors.fill: parent
        initialItem: page1

        onCurrentItemChanged: {
            if (currentItem) {
                label.text = "This is " + currentItem.objectName;
            }
        }
    }

    Page_cmp {
        id: page1
        objectName: "page1"
        backgroundColor: "red"
        buttonText: "To Green"
        onButtonClicked: stack_view.push(page2)
    }

    Page_cmp {
        id: page2
        objectName: "page2"
        visible: false
        backgroundColor: "green"
        buttonText: "To Yellow"
        onButtonClicked: stack_view.push(page3)
    }

    Page_cmp {
        id: page3
        objectName: "page3"
        visible: false
        backgroundColor: "yellow"
        buttonText: "To Red"
        onButtonClicked: {
            stack_view.pop(page1);
        }
    }
}
